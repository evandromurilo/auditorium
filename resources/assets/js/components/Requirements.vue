<template>
<div>
	<link rel="stylesheet" href="/css/style-requirements.css">
	<div class="row">
		<div class="col-sm-8 col-md-8 col-lg-8 col-md-offset-2 col-sm-offeset-2 col-lg-offset-2">
			<div class="input-group">
				<input type="text" class="form-control"  v-model="input" v-on:keyup.enter="add" id="requirement-input" placeholder="Digite aqui...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" v-on:click="add">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</button>
				</span>
			</div>
		</div>
	</div>
	<ul>
		<div class="">
			<div class="">
				<div class="">

					<span v-for="item in requirements" :item="item">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 list">
								<li>{{ item }}</li>
								<a class="delete" href="#" v-on:click="remove(item)">
									<i class="fa fa-times" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						<input type="hidden" name="requirement[]" :value="item"></input>
					</span>

				</div>
			</div>
		</div>
	</ul>
  <!--<input type="text" v-model="input" v-on:keyup.enter="add" id="requirement-input">-->
<!--  <button type="button" v-on:click="add">Add</button>-->
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
      this.requirements.push(this.input);
      this.input = "";
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
