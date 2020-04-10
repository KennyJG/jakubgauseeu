const state = {
    showPanel: false,
}

const getters = {
    isPanelVisible: (state) => state.showPanel,
};

const actions = {
    togglePanel({ commit }) {
        commit('SET_SHOW_PANEL', !state.showPanel);
    },
};

const mutations = {
    SET_SHOW_PANEL: (state, data) => {
        state.showPanel = data;
    },
};

export default { state, getters, actions, mutations }