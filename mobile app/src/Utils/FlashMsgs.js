import {showMessage} from 'react-native-flash-message';
import {Fonts, ApiError, Layout} from '../constants';
const flashMessageConfig = {
  floating: true,
  duration: 4000,
  style: {marginTop: Layout.isiOS ? 0 : 20},
  textStyle: {fontFamily: Fonts.type.base},
  titleStyle: {fontFamily: Fonts.type.base},
};
export const showErrorMessage = (alertMessage, options = {}) => {
  showMessage({
    message: 'Error',
    description: alertMessage,
    type: 'danger',
    ...flashMessageConfig,
    ...options,
  });
};
export const showSuccessMessage = (alertMessage, options = {}) => {
  showMessage({
    message: 'Success',
    description: alertMessage,
    type: 'success',
    ...flashMessageConfig,
    ...options,
  });
};
export const showNormalMessage = (alertMessage, options = {}) => {
  showMessage({
    message: 'Info',
    description: alertMessage,
    type: 'info',
    ...flashMessageConfig,
    ...options,
  });
};
export const getAPIError = (error) => {
  const {
    response: {status},
  } = error;

  if (status === ApiError.badRequest || status === ApiError.notFound) {
    return 'Something went wrong, please try again later';
  }

  if (status === ApiError.notAuthorized) {
    return 'Something went wrong, please login again';
  }
  if (__DEV__ && error.message) {
    return error.message;
  }

  return 'Something went wrong, please try again later';
};
