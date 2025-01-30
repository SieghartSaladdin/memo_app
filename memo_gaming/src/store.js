import { createStore } from 'vuex';
import count from './store/count'; // Import module count
import memo from './store/memo'; // Import module count

const store = createStore({
  modules: {
    count, // Daftarkan module count
    memo, // Daftarkan module count
  },
});

export default store;