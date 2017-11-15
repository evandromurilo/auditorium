<template>
<div>
    <link rel="stylesheet" href="/css/style-callmember-vue.css">
    <div class="container">
      <div class="">
        <div class="media">


          <div class="media-left">
            <div class="media-object well-perfil"
                 v-bind:style="{ backgroundColor: member.color }">
              <div class="letra-perfil-member">
                <span id="letra" class="text-capitalize">{{ member.name[0] }}</span>
              </div>
            </div>
          </div>


            <div class="media-body">
              <a class="media-heading nome-member" :href="'/users/' + member.id">
                <span class="">{{ member.name }}</span>
              </a>
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
