<template>
<div>
  <link rel="stylesheet" href="/css/style-requirements.css">
  <div class="row">
    <label class="col-sm-2 col-md-2 col-lg-2 control-label"></label>
    <div class="col-sm-9 col-md-9 col-lg-9">
      <div class="input-group">
        <input type="text" class="form-control" v-model="input" v-on:keyup.enter="add" id="requirement-input" placeholder="Digite aqui...">
        <span class="input-group-btn">
					<button class="btn btn-default" type="button" v-on:click="add">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</button>
				</span>
      </div>
    </div>
  </div>
  <ul>
    <div class="container">
      <span v-for="item in requirements" :item="item">
						<div class="row">
							<div class="list-principal">
								<i class="fa fa-circle list" aria-hidden="true"></i>
								<li class="list">{{ item }}</li>
								<a class="delete list" href="#" v-on:click="remove(item)">
									<i class="fa fa-times list" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						<input type="hidden" name="requirement[]" :value="item"></input>
					</span>
    </div>
  </ul>
</div>
</template>

<script>
export default {
  data() {
    return {
      requirements: [],
      input: "",
    }
  },
  methods: {
    add: function() {
      if (this.input !== "" && this.input.trim()) {
        this.requirements.push(this.input);
        this.input = "";
      }
    },

    remove: function(item) {
      this.requirements.splice(this.requirements.indexOf(item), 1);
    },
  },
  mounted() {
    console.log('Requirements: Component mounted.');

    $(document).on("keypress", "#requirement-input", function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
      }
    });
  }
}
</script>
