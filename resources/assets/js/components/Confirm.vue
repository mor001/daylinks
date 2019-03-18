<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              default footer
              <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style lang="scss" scoped>
.overlay {
  background: rgba(0, 0, 0, .8);
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 900;
  transition: all .5s ease;
}
.panel {
  width: 300px;
  height: 200px;
  background: #fff;
  padding: 20px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -150px;
  margin-top: -100px;
  transition: all .3s ease;
}
.modal-enter,
.modal-leave-active {
  opacity: 0;
}
 
.modal-enter .panel,
.modal-leave-active .panel{
  top: -200px;
}
</style>