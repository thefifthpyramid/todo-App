<template>
<div class="spinner" v-if="loading_status">
    <div class="radar-spinner" :style="spinnerStyle">
        <div class="circle">
            <div class="circle-inner-container">
                <div class="circle-inner"></div>
            </div>
        </div>

        <div class="circle">
            <div class="circle-inner-container">
                <div class="circle-inner"></div>
            </div>
        </div>

        <div class="circle">
            <div class="circle-inner-container">
                <div class="circle-inner"></div>
            </div>
        </div>

        <div class="circle">
            <div class="circle-inner-container">
                <div class="circle-inner"></div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default{
    setup:() => ({
        title:"create"
    }),
   data(){
       return{loading_status:false}
   },
   mounted(){
    window.emitter.on('changeLoadingStatus',(status) => {
        this.loading_status = status
    })
   }
}
</script>
<style scoped>
.spinner{

    position:fixed;
    z-index:1100;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background-color:black
}
.radar-spinner, .radar-spinner * {
    box-sizing: border-box;
}

.radar-spinner {
    height: 60px;
    width: 60px;
    position: relative;
    left: 47%;
    top: 40%;
}

.radar-spinner .circle {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    animation: radar-spinner-animation 2s infinite;
}

.radar-spinner .circle:nth-child(1) {
    padding: calc(60px * 5 * 2 * 0 / 110);
    animation-delay: 300ms;
}

.radar-spinner .circle:nth-child(2) {
    padding: calc(60px * 5 * 2 * 1 / 110);
    animation-delay: 300ms;
}

.radar-spinner .circle:nth-child(3) {
    padding: calc(60px * 5 * 2 * 2 / 110);
    animation-delay: 300ms;
}

.radar-spinner .circle:nth-child(4) {
    padding: calc(60px * 5 * 2 * 3 / 110);
    animation-delay: 0ms;
}

.radar-spinner .circle-inner, .radar-spinner .circle-inner-container {
    height: 100%;
    width: 100%;
    border-radius: 50%;
    border: calc(60px * 5 / 110) solid transparent;
}

.radar-spinner .circle-inner {
    border-left-color: #ff1d5e;
    border-right-color: #ff1d5e;
}

@keyframes radar-spinner-animation {
    50% {
        transform: rotate(180deg);
    }
    100% {
        transform: rotate(0deg);
    }
}
</style>
