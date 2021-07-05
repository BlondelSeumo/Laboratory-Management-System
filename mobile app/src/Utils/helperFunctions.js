import {PermissionsAndroid} from 'react-native';
import RNFetchBlob from 'rn-fetch-blob';
export const encodingURLParams = (body) => {
  var formBody = [];
  for (var property in body) {
    var encodedKey = encodeURIComponent(property);
    var encodedValue = encodeURIComponent(body[property]);
    formBody.push(encodedKey + '=' + encodedValue);
  }
  formBody = formBody.join('&');
  return formBody;
};
export const comp = (a, b) => a.toLowerCase().trim() === b.toLowerCase().trim();
export const getGender = (value) => {
  return value === 0 ? 'male' : 'female';
};

export const checkImagePickerPermissions = async () => {
  try {
    await PermissionsAndroid.requestMultiple([
      PermissionsAndroid.PERMISSIONS.CAMERA,
      PermissionsAndroid.PERMISSIONS.READ_EXTERNAL_STORAGE,
      PermissionsAndroid.PERMISSIONS.WRITE_EXTERNAL_STORAGE,
    ]);
    if (
      (await PermissionsAndroid.check('android.permission.CAMERA')) &&
      (await PermissionsAndroid.check('android.permission.CAMERA')) &&
      (await PermissionsAndroid.check('android.permission.CAMERA'))
    ) {
      return true;
    } else {
      return false;
    }
  } catch (err) {
    throw err;
  }
};

export const requestLocationPermission = async () => {
  let result = false;
  try {
    const granted = await PermissionsAndroid.request(
      PermissionsAndroid.PERMISSIONS.ACCESS_FINE_LOCATION,
      {
        title: 'Location Access Required',
        message: 'This App needs to Access your location',
      },
    );
    if (granted === PermissionsAndroid.RESULTS.GRANTED) {
      result = true;
      return result;
    } else {
      return false;
    }
  } catch (err) {
    alert('Error', err);
  }
};

export const ConvertPdfToBase64 = (url) => {
  // send http request in a new thread (using native code)
  return (
    RNFetchBlob.config({fileCache: true})
      .fetch('GET', url)
      // when response status code is 200
      .then((res) => {
        // the conversion is done in native code
        let base64Str = res.base64();
        return base64Str;
      })
      // Status code is not 200
      .catch((errorMessage, statusCode) => {
        // error handling
        alter(errorMessage);
      })
  );
};
