<template>
  <div>
        day la trang role
  </div>
</template>

<script>
import { useMenu } from '../../../stores/use-menu';
export default {
    setup(){
        useMenu().onSelectedKeys(["admin-roles"]);
    }
}
</script>

<style>

</style>