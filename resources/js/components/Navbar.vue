<template>
<div>
    <button v-on:click="counter += 1">Add 1</button>
    <p>The button above has been clicked {{ counter }} times.</p>
</div>
</template>



<script>
export default {

    data: function () {
    return {
      counter: 0
    }


    }
}
</script>
