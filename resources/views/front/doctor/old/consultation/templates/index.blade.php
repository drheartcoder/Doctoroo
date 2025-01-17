{% extends "base.blade.php" %}
{% block content %}

  <div class="container bump-me">


    <div class="body-content">


      <div class="row">
        <div class="col-lg-6 col-offset-1">

          <div class="panel panel-default">
            <div class="panel-heading">Create an archive</div>
            <div class="panel-body">
              <p>
                Everyone who joins either the Host View or Participant View
                joins a single OpenTok session. Anyone with the Host View
                open can click Start Archive or Stop Archive to control
                recording of the entire session.
              </p>
            </div> 
            <div class="panel-footer">
              <a class="btn btn-danger" href="{{ host_path }}">Host View</a>
              <a class="btn btn-danger" href="participant">Participant View</a>
            </div>
          </div>

        </div>
        <div class="col-lg-6 col-offset-1">

          <div class="panel panel-default">
            <div class="panel-heading">Play an archive</div>
            <div class="panel-body">
              <p>
                Click through to Past Archives to see examples of using the
                Archiving REST API to list archives showing status (started,
                stopped, available) and playback (for available archives).
              </p>
            </div>
            <div class="panel-footer">
              <a class="btn btn-success" href="history">Past Archives</a>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

{% endblock %}