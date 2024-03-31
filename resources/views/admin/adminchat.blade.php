@extends('admin.layout.layout')
@section('content')
<form method="post" action="{{ url('admin/adminchat') }}" onsubmit="onsubmit_Form(); return false;">@csrf
  <div class="input-group">
      <input type="text" name="input_message" id="input_message" placeholder="Type Message ..." class="form-control" autocomplete="off">
      <span class="">
        <button type="submit" class="btn btn-warning">Send</button>
      </span>
  </div>
</form>

@endsection

<script type="module">

  const elementInputMessage = document.getElementById("input_message");

  function onsubmit_Form(){

    let strMessage = elementInputMessage.value;
    if(!strMessage){
      return;
    }
    params = {'message':strMessage};

    axios
      .post('',params)
      .then(response=>{
        console.log(response);
      })
      .catch(error=>{
        console.log(error.response)
      });
    elementInputMessage.value = "";  
  }


  window.addEventListener( "DOMContentLoaded", ()=>
  {
    const elementListMessage = document.getElementById( "list_message" );

      window.Echo.private('sample3').listen( 'MessageSent', (e) =>
      {
        console.log(e);
        let strUsername = e.message.username;
        let strMessage = e.message.body;

        let elementLi = document.createElement("li");
        let elementUsername = document.createElement("strong");
        let elementMessage = document.createElement("div");
        elementUsername.textContent = strUsername;
        elementMessage.textContent = strMessage;
        elementLi.append(elementUsername);
        elementLi.append(elementMessage);
        elementListMessage.prepend(elementLi);
        // elementListMessage.append(elementLi);
      });
  });
     
</script>