<template>
<div>
    <link rel="stylesheet" href="/css/style-callmember-vue.css">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

          <a class="" style="float: right;":href="'/users/' + member.id">
            <span class="">{{ member.name }}</span>
          </a>

            <div class="well-perfil"
                 v-bind:style="{ backgroundColor: member.color }">
              <div class="letra-perfil-member">
                <span id="letra" class="text-capitalize">{{ member.name[0] }}</span>
              </div>
              </div>
        </div>
      </div>
    </div>


</div>
</template>

<script>
export default {
  props: ['member'],
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
