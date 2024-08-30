<template>
    <div>
        day la setting
    </div>
</template>

<script>
import { useMenu } from '../../../stores/use-menu';
export default {
    setup(){
        useMenu().onSelectedKeys(["admin-setting"]);
    }
}
</script>

<style>

</style>