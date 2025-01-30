export default {
    namespaced: true, // Mengaktifkan namespace untuk module ini
    state: {
      titleMemo: '', // State untuk count
      descMemo: '', // State untuk count
    },
    getters: {
      getCount: (state) => state.count, // Getter untuk mendapatkan nilai count
    },
    mutations: {
      increment(state) {
        state.count++; // Menambah nilai count
      },
      decrement(state) {
        state.count--; // Mengurangi nilai count
      },
    },
    actions: {
      asyncIncrement({ commit }) {
        setTimeout(() => {
          commit('increment'); // Memanggil mutation increment
        }, 1000);
      },
    },
  };
  