<template>
<div>
  <link rel="stylesheet" href="/css/style-newcall-vue.css">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal">
          <!-- input da chamada -->
          <div :class="'form-group' +  (errors.title ? ' has-error' : '')">
            <label class="col-md-2 control-label">Título da Chamada: </label>
            <div class="col-md-9">
              <input type="text" class="form-control" v-model="title">
            </div>
            <span class="help-block" v-if="errors.title">
								{{ errors.title }}
							</span>
          </div>

          <!--menbros-->
          <label>Membros:</label><br>
          <div class="container">
            <div class="col-md-4">
                <ul>
                  <li>{{ user.name }}</li>
                  <span v-for="u in users">
                    <span v-if="added(u.email)">
											<li v-if="u.email != user.email">
												<a v-on:click="remove(u)">{{ u.name }}
													 <i class="fa fa-minus-square" aria-hidden="true"></i>
												 </a>
											</li>
                    </span>
                    <span v-else>
                      <li v-if="u.email != user.email">
                        <a v-on:click="insert(u)">{{ u.name }}
    												<i class="fa fa-plus-square" aria-hidden="true"></i>
    											</a>
                      </li>
                    </span>
										</span>
                </ul>
            </div>
          </div>

          <!-- button cria chamada-->
          <div class="col-md-1">
            <button class="btn btn-primary" v-on:click="send">Criar chamada</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['user', 'users'],
  data() {
    return {
      post_url: "/calls?from=create_call",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      members: [this.user],
      title: '',
      request: false,
      errors: {},
    }
  },
  methods: {
    added: function(email) {
      return this.members.some(function(el) {
        return el.email == email;
      });
    },

    insert: function(user) {
      this.members.push({name: user.name, email: user.email});
    },

    remove: function(user) {
      this.members = this.members.filter(item => item.email !== user.email)
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


      var self = this;
      this.request.fail(function(response, textStatus, errorThrown) {
        console.error(
          "The following error occurred: " +
          textStatus, errorThrown
        );

        self.request = false;

        self.errors = response.responseJSON.errors;
        console.log(response);
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
