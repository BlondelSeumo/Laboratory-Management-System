import {
  Dimensions,
  I18nManager,
  Platform,
  StatusBar,
  StyleSheet,
} from 'react-native';
import {Colors} from './Colors';
import DeviceInfo from 'react-native-device-info';
export const deviceWidth = Dimensions.get('window').width;
export const deviceHight = Dimensions.get('window').height;
export const Styles = StyleSheet.create({
  safeArea_Conatiner: {
    flex: 1,
    paddingTop:
      Platform.OS === 'android' && DeviceInfo.hasNotch()
        ? StatusBar.currentHeight
        : 0,
  },
  view_Container: {
    flex: 1,
    backgroundColor: Colors.colorWhisper,
  },
  img_Background: {
    flex: 1,
  },
  view_Spinner: {flex: 1, justifyContent: 'center', alignItems: 'center'},
  icon_BackArrow: {
    color: Colors.colorWhite,
    fontSize: 25,
    transform: [{rotate: I18nManager.isRTL ? '180deg' : '0deg'}],
  },
});
