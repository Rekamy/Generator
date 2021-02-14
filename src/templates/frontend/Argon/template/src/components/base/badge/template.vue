<template>
  <component
    :is="tag"
    class="badge"
    :class="[`badge-${type}`, rounded ? `badge-pill` : '', circle && 'badge-circle', ]"
  >
    <slot>
      <i v-if="icon" :class="icon"></i>
      <span v-if="text">{{ text }}</span>
    </slot>
  </component>
</template>
<script lang="ts" src="./index.ts"></script>
