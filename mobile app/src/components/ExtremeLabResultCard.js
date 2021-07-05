import React from 'react';
import {StyleSheet, Text, View} from 'react-native';
import {Colors, Fonts} from '../constants';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import {Icon} from 'native-base';
export const ExtremeLabResultCard = ({
  ResultName,
  ResultNumber,
  onPress,
  IconName,
}) => {
  return (
    <View style={styles.button_Container} onPress={onPress}>
      <Icon name={IconName} type="FontAwesome5" style={styles.icon_Result} />
      <View style={styles.view_ResultContent}>
        <Text style={styles.txt_Button}>{ResultName}</Text>
        <Text
          style={{
            fontSize: Fonts.size.regular,
            color: Colors.colorMidnightBlue,
            alignSelf: 'flex-start',
          }}>
          {ResultNumber}
        </Text>
      </View>
    </View>
  );
};
const styles = StyleSheet.create({
  button_Container: {
    marginVertical: 10,
    width: wp('90%'),
    height: hp('13.5%'),
    backgroundColor: Colors.colorWhite,
    borderRadius: 10,
    alignItems: 'center',
    flexDirection: 'row',
    paddingHorizontal: 30,
    marginTop: 15,
  },
  txt_Button: {
    fontSize: Fonts.size.regular,
    color: Colors.colorMidnightBlue,
  },
  icon_Result: {color: Colors.colorMidnightBlue, fontSize: 20},
  view_ResultContent: {paddingHorizontal: 20},
});
