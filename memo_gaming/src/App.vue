<script>
import { mapState, mapMutations, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState({
      titleMemo: (state) => state.memo.titleMemo,
      descMemo: (state) => state.memo.descMemo
    }),
  },
  methods: {
    ...mapMutations('count', ['increment', 'decrement']),
    ...mapActions('count', ['asyncIncrement']),
  },
};
</script>

<template>
  <div class="container mx-auto">
    <h1 class="text-center text-2xl mt-12">App Memo Menggunakan Vuex</h1>

    <div class="flex gap-4 items-center justify-center mt-20">
      <form>
        <div class="flex flex-col gap-4">
          <label for="title">Title For Memo</label>
          <input v-model="this.titleMemo" class="border w-[400px] h-[35px] p-2" type="text">
          <label for="title">Description For Memo</label>
          <textarea v-model="this.descMemo" class="border w-[400px] h-[100px] p-2" type="text"></textarea>
        </div>
        <button type="submit" class="px-4 py-[6px] mt-4 bg-black text-white cursor-pointer">Send</button>
      </form>
    </div>
  </div>
</template>