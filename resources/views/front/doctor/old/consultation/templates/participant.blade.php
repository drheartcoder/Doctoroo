{% extends "base.blade.php" %}
{% block content %}

  <script src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js"></script>

  <div class="container bump-me">

    <div class="body-content">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Participant</h3>
        </div>
        <div class="panel-body">
          <div id="subscribers"><div id="publisher"></div></div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Instructions</h3>
      </div>
      <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>When</th>
                <th>You will see</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="vertical-align: middle;">Archiving is started</td>
                <td><img src="img/archiving-on-message.png"></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Archiving remains on</td>
                <td><img src="img/archiving-on-idle.png"></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Archiving is stopped</td>
                <td><img src="img/archiving-off.png"></td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>

    <script>
        var sessionId = "{{ sessionId }}";
        var apiKey = "{{ apiKey }}";
        var token = "{{ token }}";
    </script>
    <script src="{{ path }}/public/js/participant.js"></script>

  </div>

{% endblock %}
