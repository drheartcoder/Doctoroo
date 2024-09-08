/*!
 * Date picker for pickadate.js v3.5.6
 * http://amsul.github.io/pickadate.js/date.htm
 */
!function(e){"function"==typeof define&&define.amd?define(["picker","jquery"],e):"object"==typeof exports?module.exports=e(require("./picker.js"),require("jquery")):e(Picker,jQuery)}(function(e,t){function n(e,t){var n=this,i=e.$node[0],a=i.value,r=e.$node.data("value"),o=r||a,s=r?t.formatSubmit:t.format,l=function(){return i.currentStyle?"rtl"==i.currentStyle.direction:"rtl"==getComputedStyle(e.$root[0]).direction};n.settings=t,n.$node=e.$node,n.queue={min:"measure create",max:"measure create",now:"now create",select:"parse create validate",highlight:"parse navigate create validate",view:"parse create validate viewset",disable:"deactivate",enable:"activate"},n.item={},n.item.clear=null,n.item.disable=(t.disable||[]).slice(0),n.item.enable=-function(e){return!0===e[0]?e.shift():-1}(n.item.disable),n.set("min",t.min).set("max",t.max).set("now"),o?n.set("select",o,{format:s,defaultValue:!0}):n.set("select",null).set("highlight",n.item.now),n.key={40:7,38:-7,39:function(){return l()?-1:1},37:function(){return l()?1:-1},go:function(e){var t=n.item.highlight,i=new Date(t.year,t.month,t.date+e);n.set("highlight",i,{interval:e}),this.render()}},e.on("render",function(){e.$root.find("."+t.klass.selectMonth).on("change",function(){var n=this.value;n&&(e.set("highlight",[e.get("view").year,n,e.get("highlight").date]),e.$root.find("."+t.klass.selectMonth).trigger("focus"))}),e.$root.find("."+t.klass.selectYear).on("change",function(){var n=this.value;n&&(e.set("highlight",[n,e.get("view").month,e.get("highlight").date]),e.$root.find("."+t.klass.selectYear).trigger("focus"))})},1).on("open",function(){var i="";n.disabled(n.get("now"))&&(i=":not(."+t.klass.buttonToday+")"),e.$root.find("button"+i+", select").attr("disabled",!1)},1).on("close",function(){e.$root.find("button, select").attr("disabled",!0)},1)}var i=e._;n.prototype.set=function(e,t,n){var i=this,a=i.item;return null===t?("clear"==e&&(e="select"),a[e]=t,i):(a["enable"==e?"disable":"flip"==e?"enable":e]=i.queue[e].split(" ").map(function(a){return t=i[a](e,t,n)}).pop(),"select"==e?i.set("highlight",a.select,n):"highlight"==e?i.set("view",a.highlight,n):e.match(/^(flip|min|max|disable|enable)$/)&&(a.select&&i.disabled(a.select)&&i.set("select",a.select,n),a.highlight&&i.disabled(a.highlight)&&i.set("highlight",a.highlight,n)),i)},n.prototype.get=function(e){return this.item[e]},n.prototype.create=function(e,n,a){var r;return(n=void 0===n?e:n)==-1/0||n==1/0?r=n:t.isPlainObject(n)&&i.isInteger(n.pick)?n=n.obj:t.isArray(n)?(n=new Date(n[0],n[1],n[2]),n=i.isDate(n)?n:this.create().obj):n=i.isInteger(n)||i.isDate(n)?this.normalize(new Date(n),a):this.now(e,n,a),{year:r||n.getFullYear(),month:r||n.getMonth(),date:r||n.getDate(),day:r||n.getDay(),obj:r||n,pick:r||n.getTime()}},n.prototype.createRange=function(e,n){var a=this,r=function(e){return!0===e||t.isArray(e)||i.isDate(e)?a.create(e):e};return i.isInteger(e)||(e=r(e)),i.isInteger(n)||(n=r(n)),i.isInteger(e)&&t.isPlainObject(n)?e=[n.year,n.month,n.date+e]:i.isInteger(n)&&t.isPlainObject(e)&&(n=[e.year,e.month,e.date+n]),{from:r(e),to:r(n)}},n.prototype.withinRange=function(e,t){return e=this.createRange(e.from,e.to),t.pick>=e.from.pick&&t.pick<=e.to.pick},n.prototype.overlapRanges=function(e,t){return e=this.createRange(e.from,e.to),t=this.createRange(t.from,t.to),this.withinRange(e,t.from)||this.withinRange(e,t.to)||this.withinRange(t,e.from)||this.withinRange(t,e.to)},n.prototype.now=function(e,t,n){return t=new Date,n&&n.rel&&t.setDate(t.getDate()+n.rel),this.normalize(t,n)},n.prototype.navigate=function(e,n,i){var a,r,o,s,l=t.isArray(n),c=t.isPlainObject(n),d=this.item.view;if(l||c){for(c?(r=n.year,o=n.month,s=n.date):(r=+n[0],o=+n[1],s=+n[2]),i&&i.nav&&d&&d.month!==o&&(r=d.year,o=d.month),r=(a=new Date(r,o+(i&&i.nav?i.nav:0),1)).getFullYear(),o=a.getMonth();new Date(r,o,s).getMonth()!==o;)s-=1;n=[r,o,s]}return n},n.prototype.normalize=function(e){return e.setHours(0,0,0,0),e},n.prototype.measure=function(e,t){return t?"string"==typeof t?t=this.parse(e,t):i.isInteger(t)&&(t=this.now(e,t,{rel:t})):t="min"==e?-1/0:1/0,t},n.prototype.viewset=function(e,t){return this.create([t.year,t.month,1])},n.prototype.validate=function(e,n,a){var r,o,s,l,c=this,d=n,u=a&&a.interval?a.interval:1,h=-1===c.item.enable,f=c.item.min,m=c.item.max,p=h&&c.item.disable.filter(function(e){if(t.isArray(e)){var a=c.create(e).pick;a<n.pick?r=!0:a>n.pick&&(o=!0)}return i.isInteger(e)}).length;if((!a||!a.nav&&!a.defaultValue)&&(!h&&c.disabled(n)||h&&c.disabled(n)&&(p||r||o)||!h&&(n.pick<=f.pick||n.pick>=m.pick)))for(h&&!p&&(!o&&u>0||!r&&u<0)&&(u*=-1);c.disabled(n)&&(Math.abs(u)>1&&(n.month<d.month||n.month>d.month)&&(n=d,u=u>0?1:-1),n.pick<=f.pick?(s=!0,u=1,n=c.create([f.year,f.month,f.date+(n.pick===f.pick?0:-1)])):n.pick>=m.pick&&(l=!0,u=-1,n=c.create([m.year,m.month,m.date+(n.pick===m.pick?0:1)])),!s||!l);)n=c.create([n.year,n.month,n.date+u]);return n},n.prototype.disabled=function(e){var n=this,a=n.item.disable.filter(function(a){return i.isInteger(a)?e.day===(n.settings.firstDay?a:a-1)%7:t.isArray(a)||i.isDate(a)?e.pick===n.create(a).pick:t.isPlainObject(a)?n.withinRange(a,e):void 0});return a=a.length&&!a.filter(function(e){return t.isArray(e)&&"inverted"==e[3]||t.isPlainObject(e)&&e.inverted}).length,-1===n.item.enable?!a:a||e.pick<n.item.min.pick||e.pick>n.item.max.pick},n.prototype.parse=function(e,t,n){var a=this,r={};return t&&"string"==typeof t?(n&&n.format||((n=n||{}).format=a.settings.format),a.formats.toArray(n.format).map(function(e){var n=a.formats[e],o=n?i.trigger(n,a,[t,r]):e.replace(/^!/,"").length;n&&(r[e]=t.substr(0,o)),t=t.substr(o)}),[r.yyyy||r.yy,+(r.mm||r.m)-1,r.dd||r.d]):t},n.prototype.formats=function(){function e(e,t,n){var i=e.match(/[^\x00-\x7F]+|\w+/)[0];return n.mm||n.m||(n.m=t.indexOf(i)+1),i.length}function t(e){return e.match(/\w+/)[0].length}return{d:function(e,t){return e?i.digits(e):t.date},dd:function(e,t){return e?2:i.lead(t.date)},ddd:function(e,n){return e?t(e):this.settings.weekdaysShort[n.day]},dddd:function(e,n){return e?t(e):this.settings.weekdaysFull[n.day]},m:function(e,t){return e?i.digits(e):t.month+1},mm:function(e,t){return e?2:i.lead(t.month+1)},mmm:function(t,n){var i=this.settings.monthsShort;return t?e(t,i,n):i[n.month]},mmmm:function(t,n){var i=this.settings.monthsFull;return t?e(t,i,n):i[n.month]},yy:function(e,t){return e?2:(""+t.year).slice(2)},yyyy:function(e,t){return e?4:t.year},toArray:function(e){return e.split(/(d{1,4}|m{1,4}|y{4}|yy|!.)/g)},toString:function(e,t){var n=this;return n.formats.toArray(e).map(function(e){return i.trigger(n.formats[e],n,[0,t])||e.replace(/^!/,"")}).join("")}}}(),n.prototype.isDateExact=function(e,n){return i.isInteger(e)&&i.isInteger(n)||"boolean"==typeof e&&"boolean"==typeof n?e===n:(i.isDate(e)||t.isArray(e))&&(i.isDate(n)||t.isArray(n))?this.create(e).pick===this.create(n).pick:!(!t.isPlainObject(e)||!t.isPlainObject(n))&&(this.isDateExact(e.from,n.from)&&this.isDateExact(e.to,n.to))},n.prototype.isDateOverlap=function(e,n){var a=this.settings.firstDay?1:0;return i.isInteger(e)&&(i.isDate(n)||t.isArray(n))?(e=e%7+a)===this.create(n).day+1:i.isInteger(n)&&(i.isDate(e)||t.isArray(e))?(n=n%7+a)===this.create(e).day+1:!(!t.isPlainObject(e)||!t.isPlainObject(n))&&this.overlapRanges(e,n)},n.prototype.flipEnable=function(e){var t=this.item;t.enable=e||(-1==t.enable?1:-1)},n.prototype.deactivate=function(e,n){var a=this,r=a.item.disable.slice(0);return"flip"==n?a.flipEnable():!1===n?(a.flipEnable(1),r=[]):!0===n?(a.flipEnable(-1),r=[]):n.map(function(e){for(var n,o=0;o<r.length;o+=1)if(a.isDateExact(e,r[o])){n=!0;break}n||(i.isInteger(e)||i.isDate(e)||t.isArray(e)||t.isPlainObject(e)&&e.from&&e.to)&&r.push(e)}),r},n.prototype.activate=function(e,n){var a=this,r=a.item.disable,o=r.length;return"flip"==n?a.flipEnable():!0===n?(a.flipEnable(1),r=[]):!1===n?(a.flipEnable(-1),r=[]):n.map(function(e){var n,s,l,c;for(l=0;l<o;l+=1){if(s=r[l],a.isDateExact(s,e)){n=r[l]=null,c=!0;break}if(a.isDateOverlap(s,e)){t.isPlainObject(e)?(e.inverted=!0,n=e):t.isArray(e)?(n=e)[3]||n.push("inverted"):i.isDate(e)&&(n=[e.getFullYear(),e.getMonth(),e.getDate(),"inverted"]);break}}if(n)for(l=0;l<o;l+=1)if(a.isDateExact(r[l],e)){r[l]=null;break}if(c)for(l=0;l<o;l+=1)if(a.isDateOverlap(r[l],e)){r[l]=null;break}n&&r.push(n)}),r.filter(function(e){return null!=e})},n.prototype.nodes=function(e){var t=this,n=t.settings,a=t.item,r=a.now,o=a.select,s=a.highlight,l=a.view,c=a.disable,d=a.min,u=a.max,h=function(e,t){return n.firstDay&&(e.push(e.shift()),t.push(t.shift())),i.node("thead",i.node("tr",i.group({min:0,max:6,i:1,node:"th",item:function(i){return[e[i],n.klass.weekdays,'scope=col title="'+t[i]+'"']}})))}((n.showWeekdaysFull?n.weekdaysFull:n.weekdaysShort).slice(0),n.weekdaysFull.slice(0)),f=function(e){return i.node("div"," ",n.klass["nav"+(e?"Next":"Prev")]+(e&&l.year>=u.year&&l.month>=u.month||!e&&l.year<=d.year&&l.month<=d.month?" "+n.klass.navDisabled:""),"data-nav="+(e||-1)+" "+i.ariaAttr({role:"button",controls:t.$node[0].id+"_table"})+' title="'+(e?n.labelMonthNext:n.labelMonthPrev)+'"')},m=function(){var a=n.showMonthsShort?n.monthsShort:n.monthsFull;return n.selectMonths?i.node("select",i.group({min:0,max:11,i:1,node:"option",item:function(e){return[a[e],0,"value="+e+(l.month==e?" selected":"")+(l.year==d.year&&e<d.month||l.year==u.year&&e>u.month?" disabled":"")]}}),n.klass.selectMonth,(e?"":"disabled")+" "+i.ariaAttr({controls:t.$node[0].id+"_table"})+' title="'+n.labelMonthSelect+'"'):i.node("div",a[l.month],n.klass.month)},p=function(){var a=l.year,r=!0===n.selectYears?5:~~(n.selectYears/2);if(r){var o=d.year,s=u.year,c=a-r,h=a+r;if(o>c&&(h+=o-c,c=o),s<h){var f=c-o,m=h-s;c-=f>m?m:f,h=s}return i.node("select",i.group({min:c,max:h,i:1,node:"option",item:function(e){return[e,0,"value="+e+(a==e?" selected":"")]}}),n.klass.selectYear,(e?"":"disabled")+" "+i.ariaAttr({controls:t.$node[0].id+"_table"})+' title="'+n.labelYearSelect+'"')}return i.node("div",a,n.klass.year)};return i.node("div",(n.selectYears?p()+m():m()+p())+f()+f(1),n.klass.header)+i.node("table",h+i.node("tbody",i.group({min:0,max:5,i:1,node:"tr",item:function(e){var a=n.firstDay&&0===t.create([l.year,l.month,1]).day?-7:0;return[i.group({min:7*e-l.day+a+1,max:function(){return this.min+7-1},i:1,node:"td",item:function(e){e=t.create([l.year,l.month,e+(n.firstDay?1:0)]);var a=o&&o.pick==e.pick,h=s&&s.pick==e.pick,f=c&&t.disabled(e)||e.pick<d.pick||e.pick>u.pick,m=i.trigger(t.formats.toString,t,[n.format,e]);return[i.node("div",e.date,function(t){return t.push(l.month==e.month?n.klass.infocus:n.klass.outfocus),r.pick==e.pick&&t.push(n.klass.now),a&&t.push(n.klass.selected),h&&t.push(n.klass.highlighted),f&&t.push(n.klass.disabled),t.join(" ")}([n.klass.day]),"data-pick="+e.pick+" "+i.ariaAttr({role:"gridcell",label:m,selected:!(!a||t.$node.val()!==m)||null,activedescendant:!!h||null,disabled:!!f||null})),"",i.ariaAttr({role:"presentation"})]}})]}})),n.klass.table,'id="'+t.$node[0].id+'_table" '+i.ariaAttr({role:"grid",controls:t.$node[0].id,readonly:!0}))+i.node("div",i.node("button",n.today,n.klass.buttonToday,"type=button data-pick="+r.pick+(e&&!t.disabled(r)?"":" disabled")+" "+i.ariaAttr({controls:t.$node[0].id}))+i.node("button",n.clear,n.klass.buttonClear,"type=button data-clear=1"+(e?"":" disabled")+" "+i.ariaAttr({controls:t.$node[0].id}))+i.node("button",n.close,n.klass.buttonClose,"type=button data-close=true "+(e?"":" disabled")+" "+i.ariaAttr({controls:t.$node[0].id})),n.klass.footer)},n.defaults=function(e){return{labelMonthNext:"Next month",labelMonthPrev:"Previous month",labelMonthSelect:"Select a month",labelYearSelect:"Select a year",monthsFull:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],weekdaysFull:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],today:"Today",clear:"Clear",close:"Close",closeOnSelect:!0,closeOnClear:!0,format:"d mmmm, yyyy",klass:{table:e+"table",header:e+"header",navPrev:e+"nav--prev",navNext:e+"nav--next",navDisabled:e+"nav--disabled",month:e+"month",year:e+"year",selectMonth:e+"select--month",selectYear:e+"select--year",weekdays:e+"weekday",day:e+"day",disabled:e+"day--disabled",selected:e+"day--selected",highlighted:e+"day--highlighted",now:e+"day--today",infocus:e+"day--infocus",outfocus:e+"day--outfocus",footer:e+"footer",buttonClear:e+"button--clear",buttonToday:e+"button--today",buttonClose:e+"button--close"}}}(e.klasses().picker+"__"),e.extend("pickadate",n)});