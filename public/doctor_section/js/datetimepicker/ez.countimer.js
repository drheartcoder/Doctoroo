/*
* countimer - v1.0.0 - 2017-05-31 - https://github.com/envynoiz/countimer#readme
* Copyright (c) 2017 envynoiz 
*/
/**!
 * @preserve
 *
 * Simple jQuery plugin to start a basic count up timer on any HTML element.
 *
 * I wrote this plugin for using into a personal project but could be useful
 * for everyone who needs a simple counter.
 *
 * Licensed under the MIT license.
 */
;(function ($, window, document, undefined) {
  'use strict';

  var prefix = 'plugin_';
  var pluginName = 'countimer';

  var Plugin = function(element, options) {
    // Main instance
    var plugin = this;

    plugin.options = {};
    plugin.duration = {};

    // Private attributes
    const displayMode = {
      IN_SECONDS : 0,
      IN_MINUTES : 1,
      IN_HOURS : 2,
      FULL: 3,
      MAX_INDEX: 3
    };

    const eventNames = [
      'second',
      'minute',
      'hour'
    ];

    var defaultSettings = {
      displayMode : displayMode.FULL,
      enableEvents: false,
      autoStart : true,
      useHours : true,
      minuteIndicator: '',
      secondIndicator: '',
      separator : ':',
      leadingZeros: 2,
      initHours : 0,
      initMinutes : 0,
      initSeconds: 0
    };

    var elm;
    var $elm;
    var timer;
    var isStopped;
    var hasValueAttr;
    var refreshMode;
    var displayResults;

    // Private functions
    var leadingZeros = function(num, width) {
      var z = '0';
      var n = ''.concat(num);
      // If the number has the same width only return it again.
      return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    };

    var format = function(time, withSeparator, overrideZeros){
      var finalZeros = overrideZeros? overrideZeros : plugin.options.leadingZeros;
      var pre = leadingZeros(time, finalZeros);
      return withSeparator? pre.concat(plugin.options.separator) : pre;
    };

    var fixModeValue = function(value, maxIndex){
      var band = (value === '' || value > maxIndex);
      return band? maxIndex : value;
    };

    var getDefaultDuration = function(){
      return moment.duration({
        seconds : plugin.options.initSeconds,
        minutes : plugin.options.initMinutes,
        hour : plugin.options.initHours
      });
    };

    var getResponseTimer = function(){
      return {
        displayedMode: displayResults[plugin.options.displayMode](),
        original: $.extend({}, timer)
      };
    };

    var eventHandler = function(refreshConditions){
      if(plugin.options.enableEvents){
        // Find events to fire up
        $.each(refreshConditions, function (index) {
          // Trigger events
          if(refreshConditions[index]){
            $elm.trigger(eventNames[index], getResponseTimer());
          }
        });
      }
    };

    var mainTimer = function (omitRefresh) {
      // Global timer values
      timer = {
        hours: plugin.duration.hours(),
        minutes: plugin.duration.minutes(),
        seconds: plugin.duration.seconds()
      };
      var getObjExpression = function(nf, f){
        return {
          unformatted: nf,
          formatted: f
        };
      };
      // Possible expressions to print
      var expressions = {
        toSeconds : function(){
          var withoutFormat = Math.trunc(plugin.duration.asSeconds());
          var formatted = format(withoutFormat).concat(plugin.options.secondIndicator);
          return getObjExpression({seconds: withoutFormat}, formatted);
        },
        toMinutes : function(){
          var withoutFormat = Math.trunc(plugin.duration.asMinutes());
          var formatted = format(withoutFormat).concat(plugin.options.minuteIndicator);
          return getObjExpression({minutes: withoutFormat}, formatted);
        },
        toHours : function() {
          var withoutFormat = Math.trunc(plugin.duration.asHours());
          return getObjExpression({hours: withoutFormat}, format(withoutFormat));
        },
        full : function() {
          // Normal display
          var normalNf = $.extend({}, timer);
          var normal = format(timer.hours, true, 2)
            .concat(format(timer.minutes, true, 2))
            .concat(format(timer.seconds, false, 2));
          normal = normal.concat(plugin.options.secondIndicator);
          // Minutes display
          var minutesObj = expressions.toMinutes();
          var minutesNf = {
            minutes: minutesObj.unformatted.minutes,
            seconds: timer.seconds
          };
          var minutes = format(minutesNf.minutes, true).concat(format(minutesNf.seconds, false, 2));
          minutes = minutes.concat(plugin.options.secondIndicator);
          return (plugin.options.useHours)? getObjExpression(normalNf, normal) : getObjExpression(minutesNf, minutes);
        }
      };
      // Array with refresh conditions
      var refreshConditions = [
        true, // every second
        0 === timer.seconds, // every minute
        0 === timer.minutes && 0 === timer.seconds // every hour
      ];
      // Array with each function expression
      displayResults = [
        expressions.toSeconds,
        expressions.toMinutes,
        expressions.toHours,
        expressions.full
      ];
      // Set final value into element
      if(omitRefresh || refreshConditions[refreshMode]){
        // Call the method depending of displayMode
        var finalValue = displayResults[plugin.options.displayMode]();
        hasValueAttr? $elm.val(finalValue.formatted) : $elm.text(finalValue.formatted);
      }
      // Find events to fire up
      eventHandler(refreshConditions);
      // Update moment duration
      plugin.duration = moment.duration(plugin.duration.asSeconds() + 1, 'seconds');
    };

    var startTimer = function(){
      // Only if the timer is already stopped
      if(isStopped){
        // First call
        mainTimer(true);
        // Init interval
        plugin.intervalFunction = setInterval(mainTimer, 1000);
        isStopped = false;
        // In order to allow chaining calls
        return plugin;
      }
    };

    // Init function to initialize some awesome stuffs
    var init = function() {
      // Initialize public variables
      plugin.options = $.extend({}, defaultSettings, options);
      // Validate the max index
      plugin.options.displayMode = fixModeValue(plugin.options.displayMode, displayMode.MAX_INDEX);
      // Configure moment duration
      plugin.duration = getDefaultDuration();
      // Initialize private variables
      elm = element;
      $elm = $(elm);
      isStopped = true;
      hasValueAttr = undefined !== $elm.attr('value');
      refreshMode = plugin.options.displayMode <= displayMode.IN_HOURS? plugin.options.displayMode : displayMode.IN_SECONDS;
      // Start?
      if(plugin.options.autoStart){
        plugin.start();
      }else{
        mainTimer(true);
      }
    };

    // Start count timer from initial values
    plugin.start = function(){
      plugin.duration = getDefaultDuration();
      return startTimer();
    };

    // Resume the counter
    plugin.resume = function(){
      return startTimer();
    };

    // Stop the counter
    plugin.stop = function(){
      if(plugin.intervalFunction){
        clearInterval(plugin.intervalFunction);
        isStopped = true;
      }
      // In order to allow chaining calls
      return plugin;
    };

    // Band to know if the counter has been stopped or not
    plugin.stopped = function(){
      return isStopped;
    };

    // Return the current time
    plugin.current = function(){
      return getResponseTimer();
    };

    // Fire up the plugin calling its "constructor" method
    init();
  };

  // Init jQuery plugin
  $.fn[ pluginName ] = function(methodOrOptions) {
    var method = ('string' === typeof methodOrOptions) ? methodOrOptions : undefined;

    if (method) {
      var plugins = [];

      // Each HTML elements and get the current plugin instance
      this.each(function() {
        plugins.push( $(this).data(prefix.concat(pluginName)) );
      });

      // Retrieve arguments from params
      var args = (arguments.length > 1) ? Array.prototype.slice.call(arguments, 1) : undefined;
      var results = [];

      var applyMethod = function(index) {
        var plugin = plugins[index];
        // Is plugin already instanced ?
        if (!plugin) {
          throw new Error(pluginName.concat(' is not instantiated yet'));
        }
        // Does the method exist?
        if ('function' !== typeof plugin[method]) {
          throw new Error('Method '.concat(method).concat(' is not defined on ').concat(pluginName));
        }
        // Call function and preserve result
        results.push(plugin[method].apply(plugin, args));
      };

      // Call the method in each instance
      this.each(applyMethod);

      // Return one or more results depending of the number of HTML elements
      return (results.length > 1) ? results : results[0];
    }

    // It's not a method
    var options = ('object' === typeof methodOrOptions) ? methodOrOptions : undefined;

    return this.each( function() {
      // If the instance doesn't exist, then initialize it
      if ( !$(this).data(prefix.concat(pluginName)) ) {
        $(this).data(prefix.concat(pluginName), new Plugin(this, options));
      }
    });

  };

}(jQuery, window, document));
