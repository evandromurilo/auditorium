<template>
<div>
  <link rel="stylesheet" href="/css/style-callmember-vue.css">

  <h5 class="text-left text-capitalize">{{ member.name }}</h5>
  <div class="well well-perfil" v-bind:style="{ backgroundColor: member.color }">
    <div class="letra-perfil-member">
      <span id="letra" class="text-capitalize">{{ member.name[0] }}</span>
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
