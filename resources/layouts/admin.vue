<template>
  <div>
    <the-header/>
    <!-- chia layout -->
    <div class="container-fluid  mt-3">
        <div class="row">
            <div class="col-sm-3 d-none d-sm-flex">
                <a-list bordered style="width: 100%;">
                    <the-menu/>
                <template #header>
                    <div>BANG DIEU KHIEN</div>
                </template>
  </a-list>
            </div>
            <div class="col-12 col-sm-9">
                <router-view></router-view>
            </div>
        </div>
    </div>
    
  </div>
</template>

<script>
import TheHeader from '../components/TheHeader.vue';
import TheMenu from '../components/TheMenu.vue';
export default {
    components:{
        TheHeader,
        TheMenu
    }
}
</script>

<style>

</style>