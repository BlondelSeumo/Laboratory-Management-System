import {Platform, Dimensions} from 'react-native';
const width = Dimensions.get('window').width;
const height = Dimensions.get('window').height;
export const Layout = {
  size: {width, height},
  isiOS: Platform.OS === 'ios',
};
