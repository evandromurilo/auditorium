<template>
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal">

          <div class="form-group">
            <label class="col-md-2 control-label">Título: </label>
            <div class="col-md-9">
              <input type="text" class="form-control" v-model="title">
            </div>
          </div>


          <div class="form-group">
            <label class="col-md-2 control-label">Email</label>
            <div class="col-md-4">
              <input type="text" size="30" class="form-control" maxlength="30" v-model="email">
            </div>


            <div class="col-md-1">
              <button class="btn btn-success" v-on:click="insert">Add</button>
            </div>

            <div class="col-md-1">
              <button class="btn btn-primary" v-on:click="send">Criar chamada</button>
            </div>
          </div>

        </div>
      </div>

      <ul>
        <li v-for="member in members">
          <p>{{ member.email }}</p>
        </li>
      </ul>


    </div>
  </div>

</div>
</template>

<script>
export default {
  props: ['user'],
  data() {
    return {
      post_url: "/calls?from=create_call",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      members: [this.user],
      email: '',
      title: '',
      request: false,
    }
  },
  methods: {
    insert: function() {
      //$.get("/users/json?email="+this.email);
      self = this;

      var user = {
        email: self.email
      };

      this.members.push(user);
      this.email = '';
    },

    send: function() {
      if (this.request) {
        return;
      }

      var inputs = {
        _token: this.csrf_token,
        title: this.title,
        members: this.members,
        user_id: this.user.id,
      }

      this.request = $.post(this.post_url, inputs);

      this.request.done(function(response, textStatus, jqXHR) {
        console.log('Call criada!');
        window.location.replace(response);
      });


      this.request.fail(function(response, textStatus, errorThrown) {
        console.error(
          "The following error occurred: " +
          textStatus, errorThrown
        );
      });

    }
  },
  mounted() {
    console.log('NewCall: Component mounted.');
  }
}
</script>

<!-- CSS por aqui ate ver o que fazer-->
<style >
body {
  margin: 0;
  padding: 0;
}

.well-perfil {
  width: 120px;
  height: 120px;
  border-radius: 100%;
}

.well-chat {
  margin-top: 70px;
  height: 400px;
  overflow: auto;

}

.well-assunto {}
</style>
