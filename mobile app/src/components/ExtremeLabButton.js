import React from 'react';
import {StyleSheet, Text, TouchableOpacity} from 'react-native';
import {Colors, Fonts} from '../constants';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import LinearGradient from 'react-native-linear-gradient';
export const ExtremeLabButton = ({ButtonText, onPress}) => {
  return (
    <TouchableOpacity style={styles.button_Container} onPress={() => onPress()}>
      <LinearGradient
        useAngle={true}
        angle={270}
        angleCenter={{x: 0.5, y: 0.5}}
        colors={['#002A9E', '#0547FF']}
        style={styles.gradient_Container}>
        <Text style={styles.txt_Button}>{ButtonText}</Text>
      </LinearGradient>
    </TouchableOpacity>
  );
};
const styles = StyleSheet.create({
  button_Container: {
    marginVertical: 10,
    width: wp('90%'),
    height: hp('9%'),
  },
  gradient_Container: {
    flex: 1,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  txt_Button: {
    fontSize: Fonts.size.h5,
    textAlign: 'center',
    color: Colors.colorWhite,
  },
});
