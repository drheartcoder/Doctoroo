var session=TB.initSession(sessionId),publisher=TB.initPublisher(apiKey,"publisher");session.on({sessionConnected:function(s){session.publish(publisher)},streamCreated:function(s){var e=document.createElement("div");e.id="stream-"+s.stream.streamId,document.getElementById("subscribers").appendChild(e),session.subscribe(s.stream,e)}}),session.connect(apiKey,token);