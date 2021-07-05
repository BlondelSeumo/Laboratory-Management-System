import axios from 'axios';
class NetworkManager {
  static apiGetRequestHeader() {
    const header = {
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
    };

    return header;
  }
  static apiPostRequestHeader() {
    const header = {
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    };

    return header;
  }
  static getDataWithUrl = (url, params, callback = (_) => 0) => {
    const header = this.apiGetRequestHeader();
    return axios
      .get(url, params, header)
      .then((response) => {
        if (response.data.code !== 200) {
          throw new Error(response.data.message);
        }
        callback(response, null);
        return response.data;
      })
      .catch((error) => {
        callback(null, error);
        return error;
      });
  };

  static postDataWithUrl = async (url, params, callback = (a) => a) => {
    const header = this.apiPostRequestHeader();
    return axios
      .post(url, params, header)
      .then((response) => {
        if (response.data.code !== 200) {
          throw new Error(response.data.message);
        }
        callback(response, null);
        return response && response.data;
      })
      .catch((error) => {
        callback(null, error);
        return error;
      });
  };
}

export default NetworkManager;
