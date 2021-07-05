import createDataContext from './createContext';
import * as types from './../constants/ActionTypes';
import {API_ENDPOINTS} from '../constants/APIConfig';
import NetworkManager from '../networkManager/NetworkManager';
import axios from 'axios';
import {setUserDataToLocal} from '../StorageManager/index';
const INITIAL_STATE = {
  isLoading: true,
  isSignout: true,
  userData: null,
  branches: null,
  userLanguage: null,
};
const authReducer = (state = INITIAL_STATE, action) => {
  switch (action.type) {
    case types.SET_USER_DATA:
      return {
        state,
        isSignout: false,
        userData: action.payload,
      };
    case types.SET_USER_LANGUAGE: {
      return {
        ...state,
        userLanguage: action.payload,
      };
    }
    case types.GET_ALL_BRANCHES:
      return {
        ...state,
        branches: action.payload,
      };
    case types.RESTORE_USER_DATA:
      return {
        ...state,
        isLoading: false,
        userData: action.payload,
        isSignout: true,
      };
    case types.SIGN_OUT:
      return {
        ...state,
        userData: null,
        isLoading: false,
      };
    default:
      return state;
  }
};

// set user lanaguage
const setLangaugeContext = (dispatch) => {
  return (value) => {
    dispatch({
      type: types.SET_USER_LANGUAGE,
      payload: value,
    });
  };
};

const signout = (dispatch) => {
  return () => {
    dispatch({type: types.SIGN_OUT});
  };
};
const RestoreUserData = (dispatch) => {
  return (value) => {
    dispatch({type: types.RESTORE_USER_DATA, payload: value});
  };
};
const setUserDataContext = (dispatch) => {
  return async (responseBody) => {
    await setUserDataToLocal(responseBody);
    dispatch({type: types.SET_USER_DATA, payload: responseBody});
  };
};
//login
const login = () => {
  return async (params, callback) => {
    await NetworkManager.postDataWithUrl(API_ENDPOINTS.login, params, callback);
  };
};
//forget
const forgetCode = () => {
  return async (params, callback) => {
    await NetworkManager.postDataWithUrl(
      API_ENDPOINTS.forgetPatientCode,
      params,
      callback,
    );
  };
};
//create
const createNewAccount = () => {
  return async (params, callback) => {
    await NetworkManager.postDataWithUrl(
      API_ENDPOINTS.register,
      params,
      callback,
    );
  };
};

// update
const updatePatientDate = () => {
  return async (params, callback) => {
    await NetworkManager.postDataWithUrl(
      API_ENDPOINTS.updatePatientDate,
      params,
      callback,
    );
  };
};

// allBranches

const setBranchesContext = (dispatch) => {
  return async (response) => {
    dispatch({
      type: types.GET_ALL_BRANCHES,
      payload: response.data.body.braches,
    });
  };
};

const getAllLabBranches = (dispatch) => {
  return async (callback) => {
    await NetworkManager.getDataWithUrl(
      API_ENDPOINTS.getAllLabBranches,
      null,
      callback,
    );
  };
};

// reserve
const reserveHomeVisit = (dispatch) => {
  return async (params, callback) => {
    await NetworkManager.postDataWithUrl(
      API_ENDPOINTS.reserveHomeVisit,
      params,
      callback,
    );
  };
};

export const {Context, Provider} = createDataContext(
  authReducer,
  {
    setLangaugeContext,
    setUserDataContext,
    login,
    signout,
    RestoreUserData,
    createNewAccount,
    forgetCode,
    updatePatientDate,
    reserveHomeVisit,
    setBranchesContext,
    getAllLabBranches,
  },
  INITIAL_STATE,
);
