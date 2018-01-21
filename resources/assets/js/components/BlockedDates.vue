<template>
	<div>
		<ul>
      <span v-for="item in dates" :item="item">
        <li>{{ item.date }}
          <span v-if="item.motive">({{ item.motive }})</span>
          <a href="#" v-on:click="remove(item)">x</a>
        </li>
        <input type="hidden" name="date[]" :value="item.date"></input>
      </span>
		</ul>

    <input type="text"
           v-model="date_input"
           v-on:keyup.enter="add"
           id="date-input"
           placeholder="01/01/2018"
           pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"></input>

    <input type="text"
           v-model="motive_input"
           v-on:keyup.enter="add"
           id="motive-input"
           placeholder="Feriado prolongado"></input>

    <input type="checkbox"
           v-model="block_input">Bloquear</input>

    <button type="button" v-on:click="add">Add</button>
	</div>
</template>


<script>
export default {
	data() {
		return {
			dates: [],
      date_input: "",
      motive_input: "",
      block_input: true,
		}
	},
	methods: {
    add: function() {
      var new_date = {
        'date': this.date_input,
        'motive': this.motive_input,
        'id': 0,
      };

      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'POST';
      data['date'] = this.date_input;
      data['motive'] = this.motive_input;
      data['block'] = this.block_input ? '1' : '0';

      $.ajax({
        url: '/blocked-dates/',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          new_date.id = data.responseText;
          console.debug(data);
        }
      });

      this.dates.push(new_date);

      this.date_input = "";
      this.motive_input = "";
    },

    remove: function(item) {
      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'DELETE';
      data['date_id'] = item.id;

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

    dateFormat: function(dateString) {
			var dateParts = dateString.split('-');
      return dateParts[2] + "/" + dateParts[1] + "/" + dateParts[0];
    },
	},
	mounted() {
		console.log('Blocked Dates: Component mounted.');

    $(document).on("keypress", "#date-input", function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
      }
    });

    $(document).on("keypress", "#motive-input", function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        $("#date-input").focus();
      }
    });

    self = this;

    $.get('/blocked-dates.json/', function(data) {
      self.dates = data;

      self.dates.forEach(function(d) {
        d.date = self.dateFormat(d.date);
      });
    });
	}
}
</script>
