class Messages extends React.Component {
  render(){

    return this.props.messages.map( msg => {
        let containerClass = 'message-container';

        if(msg.msg_from == this.props.curUser){
          containerClass = 'message-container own-message';
          msg.msg_from = 'You';
        }

        return (
          <div className={ containerClass }>
            <div
            className="message-text"
            dangerouslySetInnerHTML={{ __html:msg.message }}>
            </div>
            <div className="message-sender">{msg.msg_from}</div>
          </div>
        );
    })
  }
}
