<script>
import { mapState , mapActions } from 'vuex';


export default {
  data() {
    return {
      titleMemo: '',
      descMemo: '',
      filterArsipStatus: 0,
    };
  },
  computed: {
  ...mapState({
    memoData: (state) => state.memo.memoData.data || [],
  }),
  filteredData() {
    return this.memoData.filter(
      (item) => item.arsip === this.filterArsipStatus
    );
  },
},
  methods: {
    ...mapActions({
      getData: 'memo/fetchMemoData',
      createData: 'memo/postMemoData',
      deleteData: 'memo/deleteMemoData',
      toggleArsipMemo: 'memo/toggleArsipMemo',
      
      submitForm() {
        const memo = {
          title: this.titleMemo,
          description: this.descMemo,
        };

        this.createData(memo) // Panggil action Vuex untuk post data
        .then(() => {
          // Reset nilai input setelah data berhasil dikirim
          this.titleMemo = "";
          this.descMemo = "";
        })
        .catch((error) => {
          console.error("Error submitting memo:", error);
        });
      },
    }),
  },
  mounted() {
    this.getData(); 
  },
};
</script>

<template>
  <div class="container mx-auto">
    <h1 class="text-center text-2xl mt-12">App Memo Menggunakan Vuex</h1>

    <div class="flex justify-center gap-20 mt-20">
      <div class="flex gap-4 justify-center">
        <form @submit.prevent="this.submitForm">
          <div class="flex flex-col gap-4">
            <label for="title">Title For Memo</label>
            <input v-model="titleMemo" class="border w-[400px] h-[35px] p-2" required type="text">
            <label for="title">Description For Memo</label>
            <textarea v-model="descMemo" class="border w-[400px] h-[100px] p-2" required type="text"></textarea>
          </div>
          <button type="submit" class="px-4 py-[6px] mt-4 bg-black text-white cursor-pointer">Send</button>
        </form>
      </div>
      <div>
        <nav>
          <ul class="flex gap-4 mb-8">
            <li
              class="cursor-pointer border-b-2"
              :class="filterArsipStatus === 0 ? 'border-black' : 'border-transparent hover:border-gray-400'"
              @click="filterArsipStatus = 0"
            >
              Home
            </li>
            <li
              class="cursor-pointer border-b-2"
              :class="filterArsipStatus === 1 ? 'border-black' : 'border-transparent hover:border-gray-400'"
              @click="filterArsipStatus = 1"
            >
              Archive
            </li>
          </ul>
        </nav>
        <div class="w-[500px] h-[400px] overflow-hidden overflow-y-scroll grid grid-cols-2 gap-6 z-10 px-8 py-4">
          <div v-for="(item, index) in this.filteredData" :key="index" class="border w-auto border h-[200px] relative z-10 group">
            <div class="flex gap-2 z-20 -top-5 -right-3 absolute">
              <div @click="this.toggleArsipMemo(item.id)" class="bg-yellow-600 p-[10px] h-[35px] transition duration-300 flex justify-center items-center text-slate-100 opacity-0 group-hover:opacity-100 cursor-pointer">
                Arsip
              </div>

              <div @click="this.deleteData(item.id)" class="bg-red-600 p-[10px] h-[35px] transition duration-300 flex justify-center items-center text-white opacity-0 group-hover:opacity-100 cursor-pointer">
                X
              </div>

              
            </div>
            
            <div class="border-b p-2">
              {{item.title}}
            </div>
            <p class="p-2 text-sm">
              {{ item.description }}
            </p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</template>