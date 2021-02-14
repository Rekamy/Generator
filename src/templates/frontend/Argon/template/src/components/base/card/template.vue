<template>
  <div
    class="card"
    :class="[
      { 'card-lift--hover': hover },
      { shadow: shadow },
      { [`shadow-${shadowSize}`]: shadowSize },
      { [`bg-gradient-${gradient}`]: gradient },
      { [`bg-${type}`]: type },
    ]"
  >
    <div class="card-header" :class="headerClasses" v-if="$slots.header">
      <slot name="header"> </slot>
    </div>
    <div class="card-body" :class="bodyClasses" v-if="!noBody">
      <slot></slot>
    </div>

    <slot v-if="noBody"></slot>

    <div class="card-footer" :class="footerClasses" v-if="$slots.footer">
      <slot name="footer"></slot>
    </div>
  </div>
</template>
<script lang="ts" src="./index.ts"></script>
