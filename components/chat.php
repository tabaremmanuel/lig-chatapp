<script type="text/babel" src="./components/js/Messages.js"></script>
<script type="text/babel">
class Chat extends React.Component{

  state = {
    messages: [
      {
        'created_at': '2019-05-20',
        'msg_from': 'May',
        'message': 'Hi Ken,<br/>I just sent the document to you on mail.<br/>Plz check it!'
      },
      {
        'created_at': '2019-05-20',
        'msg_from': 'Ken',
        'message': 'Thank you May!<br/>It was great.'
      },
      {
        'created_at': '2019-05-20',
        'msg_from': 'Ken',
        'message': 'I just checked it.<br/>Thanks!'
      },
      {
        'created_at': '2019-05-20',
        'msg_from': 'Mark',
        'message': 'Hi guys, what’s up?'
      },
      {
        'created_at': '2019-05-20',
        'msg_from': 'April',
        'message': 'Hi Mark, I stay Cebu now'
      }
    ],
    currentUser: 'Ken'
  }

  render(){
    return(
      <div>
        <div className="container">
            <Messages
              curUser={this.state.currentUser}
              messages={this.state.messages} />
        </div>
        <div className="type-box">
          <div className="container">
            <input type="text" placeholder="Start a new message" value={this.state.message} />
            <button className="btn">send</button>
          </div>
        </div>
      </div>
    )
  }
}
</script>
