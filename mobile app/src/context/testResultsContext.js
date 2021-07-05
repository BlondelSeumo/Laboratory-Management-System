import createDataContext from './createContext';
import * as types from '../constants/ActionTypes';
import NetworkManager from '../networkManager/NetworkManager';
import {API_ENDPOINTS} from '../constants/APIConfig';
import {getAPIError, showErrorMessage} from '../Utils/FlashMsgs';

const INITIAL_STATE = {
  dashboardData: {},
  allTestResults: [],
};
//TODO: Restructure group test  using callbacks
const testResultsReducer = (state = INITIAL_STATE, action) => {
  switch (action.type) {
    case types.GET_PATIENT_DASHBOARD_Data:
      return {
        ...state,
        dashboardData: action.payload,
      };
    case types.GET_ALL_TEST_RESULT:
      return {
        ...state,
        allTestResults: action.payload,
      };
    default:
      return state;
  }
};

const getGroupTestsData = (dispatch) => {
  return async () => {
    await NetworkManager.getDataWithUrl(
      API_ENDPOINTS.getPatientGroupTests,
      null,
      (response, error) => {
        if (!error) {
          dispatch({
            type: types.GET_ALL_TEST_RESULT,
            payload: response.data.body.groups,
          });
        } else {
          if (!!error.message) {
            showErrorMessage(error.message);
          } else {
            showErrorMessage(getAPIError(error));
          }
        }
      },
    );
  };
};

const getDashboardData = (dispatch) => {
  return async () => {
    await NetworkManager.getDataWithUrl(
      API_ENDPOINTS.getpatientDashboard,
      null,
      (response, error) => {
        if (!error) {
          dispatch({
            type: types.GET_PATIENT_DASHBOARD_Data,
            payload: response.data.body,
          });
        } else {
          if (!!error.message) {
            showErrorMessage(error.message);
          } else {
            showErrorMessage(getAPIError(error));
          }
        }
      },
    );
  };
};

export const {Context, Provider} = createDataContext(
  testResultsReducer,
  {
    getDashboardData,
    getGroupTestsData,
  },
  INITIAL_STATE,
);
