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
    currentUser: '<?php echo $_SESSION['username']; ?>',
    newMsg: ''
  }

  componentDidMount() {
    this.getMessages
  }

  getMessages => {
    const url = '/php/messages.php'
    axios.get(url).then(response => response.data)
    .then((data) => {
      this.setState({ messages: data })
      // console.log(data);
      console.log(this.state.messages)
     })
  }

  newMessageHandler = event => {
    this.state.newMsg = event.target.value;
  }

  sendMessageHandler = () => {
    event.preventDefault();

    let formData = new FormData();
    formData.append('message', this.state.newMsg);
    formData.append('msg_from', this.state.currentUser);

    if(formData.message != '' && formData.message != ''){
      axios({
          method: 'post',
          url: '/php/messages.php',
          data: formData,
          config: { headers: {'Content-Type': 'multipart/form-data' }}
      })
      .then(function (response) {
          //handle success
          console.log(response);
          axios.get(url).then(response => response.data)
          .then((data) => {
            this.setState({ messages: data })
            // console.log(data);
            console.log(this.state.messages)
           })

      })
      .catch(function (response) {
          //handle error
          console.log(response)
      });
    }
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
            <textarea
              onChange={this.newMessageHandler.bind(event)}
              placeholder="Start a new message"
              value={this.state.message} />
            <button
              onClick={this.sendMessageHandler}
              className="btn">send</button>
          </div>
        </div>
      </div>
    )
  }
}
</script>
