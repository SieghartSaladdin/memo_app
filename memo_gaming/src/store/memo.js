import axios from "axios";

export default {
  namespaced: true,
  state: {
    memoData: [],
  },
  getters: {
    getMemoData: (state) => state.memoData
  },
  mutations: {
    setMemoData(state, data) {
      state.memoData = data;
    },
  },
  actions: {
    async fetchMemoData({ commit }) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/memo-data');
        console.log('Data fetched:', response.data);
        commit('setMemoData', response.data);

      } catch (error) {
        console.error('Error fetching memo data:', error);
      }
    },
  
    async postMemoData({ dispatch }, memo) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/create-memo', memo);
        console.log('Memo successfully created:', response.data);
  
        await dispatch('fetchMemoData');
        
      } catch (error) {
        console.error('Error posting memo data:', error);
      }
    },

    async deleteMemoData({ dispatch }, id) {
      console.log(id)
      try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/delete-memo-${id}`);
        console.log('Memo successfully deleted:', response.data);
  
        await dispatch('fetchMemoData');
        
      } catch (error) {
        console.error('Error memo data:', error);
      }
    },

    async toggleArsipMemo({ dispatch }, id) {
      console.log(id)
      try {
        const response = await axios.post(`http://127.0.0.1:8000/api/togglearsip-memo-${id}`);
        await dispatch('fetchMemoData');
        
      } catch (error) {
        console.error('Error memo data:', error);
      }
    },
  }  
};
