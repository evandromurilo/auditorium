<template>
	<div>
		<ul>
      <span v-for="item in dates" :item="item">
        <li>{{ item.date }}
          <a href="#" v-on:click="remove(item)">x</a>
        </li>
        <input type="hidden" name="date[]" :value="item.date"></input>
      </span>
		</ul>

    <input type="text" v-model="input" v-on:keyup.enter="add" id="date-input">
    <button type="button" v-on:click="add">Add</button>
	</div>
</template>

<script>
export default {
	data() {
		return {
			dates: [],
      input: "",
		}
	},
	methods: {
    add: function() {
      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'POST';
      data['date'] = this.input;

      $.ajax({
        url: '/blocked-dates/',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          console.debug(data);
        }
      });

      this.dates.push({ 'date': this.input });
      this.input = "";
    },

    remove: function(item) {
      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'DELETE';
      data['date'] = item.date;

      $.ajax({
        url: '/blocked-dates/',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          console.debug(data);
        }
      });

      this.dates.splice(this.dates.indexOf(item), 1);
    },
	},
	mounted() {
		console.log('Blocked Dates: Component mounted.');

    $(document).on("keypress", "#date-input", function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
      }
    });

    self = this;

    $.get('/blocked-dates.json/', function(data) {
      self.dates = data;
    });
	}
}
</script>
