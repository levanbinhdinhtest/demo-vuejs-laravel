<template>
    <div>
        <div class="container-fluid">
            <div class="row text-white" style="background-color: #0c713d; padding: 1rem;">
                <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
                    <span @click="showDrawer()">X</span>
                </div>
                <div class="col-10 col-sm-9 d-flex  align-items-center justify-content-center justify-content-sm-start">
                    <img src="../assets/pts12.jpg" alt="logo" width="34" height="32" class="ms-3 me-3">
                    <span class="d-none s-sm-flex">Quan Tri</span>
                </div>
                <div class="col-sm-3 d-none d-sm-flex align-items-center justify-content-sm-end">
                    <span>Admin</span>
                </div>
                <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
                    <span @click="showDrawer_user()">X</span>
                </div>
            </div>
        <a-drawer
            v-model:open="open"
            title="Danh Muc"
            placement="left"
        >
            <the-menu/>
        </a-drawer>
        <a-drawer
            v-model:open="open_user"
            title="Account"
            placement="right"
        >
            <p>Some contents...</p>
            <p>Some contents...</p>
            <p>Some contents...</p>
        </a-drawer>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import TheMenu from './TheMenu.vue';
export default defineComponent({
    components:{
        TheMenu
    },
    setup(){
    const open = ref(false);
    const open_user = ref(false);
    const showDrawer = () => {
     open.value = true;
    };
    const showDrawer_user = () => {
        open_user.value = true;
    };
    return{
        open,
        open_user,
        showDrawer,showDrawer_user
    }
       }
})
</script>

<style>

</style>