

<template>

<div>


  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h1>{{ call.title }}</h1>
      </div>

      <div class="col-md-8 well">
        <ul class="messages">
          <call-message v-for="message in n_messages" :message="message"></call-message>
        </ul>


      <form method="POST" :action="post_url">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" :value="csrf_token">
        <input type="hidden" name="call_id" :value="call.id">
				<div class="form-group">
					<input class="form-control" type="text" name="body">
				</div>
				<div class="form-group">
					 <input class="btn btn-primary" type="submit">
				</div>

      </form>
			</div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['call', 'messages', 'members'],
  data() {
    return {
      post_url: "/messages",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      members_lookup: {},
      n_messages: [],
    }
  },
  mounted() {
    console.log('Calls: Component mounted.');

    for (var i = 0, len = this.members.length; i < len; i++) {
      this.members_lookup[this.members[i].id] = this.members[i];
    }

    for (var i = 0, len = this.messages.length; i < len; i++) {
      this.messages[i].author = this.members_lookup[this.messages[i].user_id];
      this.n_messages.push(this.messages[i]);
    }

    console.log(this.messages);
  }
}
</script>


<style>
h1{
	color: green;
}

</style>
