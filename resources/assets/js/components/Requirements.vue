<template>

	<div>
		<ul>
      <span v-for="item in requirements" :item="item">
        <li>{{ item }}</li>
        <a href="#" v-on:click="remove(item)">X</a>
        <input type="hidden" name="requirement[]" :value="item"></input>
      </span>
		</ul>

    <input type="text" v-model="input" v-on:keyup.enter="add" id="requirement-input">
    <button type="button" v-on:click="add">Add</button>
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
