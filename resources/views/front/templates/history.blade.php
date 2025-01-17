{% extends "base.blade.php" %}
{% block content %}

  <div class="container bump-me">

    <div class="body-content">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Past Recordings</h3>
        </div>
        <div class="panel-body">
          {% if archives|length > 0 %}
          <table class="table">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Created</th>
                <th>Duration</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              {% for item in archives %}

              <tr data-item-id="{{ item.id }}">
                <td>
                  {% if item.status == "available" and item.url is defined and item.url|length > 0 %}
                  <a href="http://192.168.1.31/doctoroo/public/doctor/download/{{ item.id }}">
                  {% endif %}
                  {{ item.name|default("Untitled") }}
                  {% if item.status == "available" and item.url is defined and item.url|length > 0 %}
                  </a>
                  {% endif %}
                </td>
                <td>{{ (item.createdAt//1000)|date }}</td>
                <td>{{ item.duration }} seconds</td>
                <td>{{ item.status }}</td>
                <td>
                  {% if item.status == "available" %}
                    <a href="http://192.168.1.31/doctoroo/public/doctor/delete/{{ item.id }}">Delete</a>
                  {% else %}
                    &nbsp;
                  {% endif %}
                </td>
              </tr>

              {% endfor %}
            </tbody>
          </table>
          {% else %}
          <p>
            There are no archives currently. Try making one in the <a href="/host">host view</a>.
          </p>
          {% endif %}
        </div>
        <div class="panel-footer">
          {%if showPrevious is defined %}
            <a href="{{ showPrevious }}" class="pull-left">&larr; Newer</a>
          {% endif %}
          &nbsp;
          {%if showNext is defined %}
            <a href="{{ showNext }}" class="pull-right">Older &rarr;</a>
          {% endif %}
        </div>
      </div>
    </div>
  </div>

{% endblock %}
