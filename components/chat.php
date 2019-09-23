<script type="text/babel" src="./components/Messages.js"></script>
<script type="text/babel">
class Chat extends React.Component{
  state = {
    messages: [],
    currentUser: '<?php echo $_SESSION['username']; ?>',
    newMsg: '',
  }

  componentDidMount() {
    this.getNewMessages()
  }

  componentDidUpdate(prevProps, prevState, snapshot) {
    // if(prevState.messages.length !== this.state.messages.length)
      this.getNewMessages()
  }

  getNewMessages(){
    const url = '/php/messages.php'
    axios.get(url).then(response => response.data)
    .then((data) => {
      this.setState({ messages: data })
     })
  }

  newMessageHandler = event => {
    this.state.newMsg = event.target.value;
  }

  updateNextLine = string => {
    const spltStr = string.split('\n')
    string = spltStr.join('<br/>')

    return string;
  }

  sendMessageHandler = () => {
    event.preventDefault()

    let formData = new FormData()
    formData.append('message', this.updateNextLine(this.state.newMsg))
    formData.append('msg_from', this.state.currentUser)

    this.setState({ newMsg: '' })
    setTimeout(this.chatUI.scrollTop = this.chatUI.scrollHeight,1000)

    if(this.state.newMsg){
      axios({
        method: 'post',
        url: '/php/messages.php',
        data: formData,
        config: { headers: {'Content-Type': 'multipart/form-data' }}
      })
      .then(function (response) {
        //handle success
        this.getNewMessages()

      })
      .catch(function (response) {
        //handle error
        // console.log(response)
      });
    }else
      console.log('New Message Empty!')
  }

  chatUI = () => null

  render(){
    return(
      <div
        style = {{
          height: window.innerHeight - 202 + 'px',
          'overflow-y':'scroll'
        }}
        ref = { el => this.chatUI = el  }
        className = "chat-ui">
        <div className="container">
            <Messages
              curUser={this.state.currentUser}
              messages={this.state.messages} />
        </div>
        <div className="type-box" >
          <div className="container">
            <textarea
              onChange={this.newMessageHandler.bind(event)}
              placeholder="Start a new message"
              value={this.state.newMsg} />
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
