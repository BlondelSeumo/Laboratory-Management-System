import React from 'react';
import {StyleSheet} from 'react-native';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import {Icon, Item, Input} from 'native-base';
import {Colors} from '../constants';
export const ExtremeLabTextInput = ({
  placeholderTxt,
  value,
  onChangeText,
  iconName,
  iconType,
  keyboardType,
  returnKeyType,
  rtl,
}) => {
  return (
    <Item style={styles.txtInput_Container} rounded>
      <Icon
        active
        name={iconName}
        type={iconType}
        style={styles.icon_TextInput}
      />
      <Input
        autoCapitalize="none"
        underlineColorAndroid="transparent"
        placeholder={placeholderTxt}
        value={value}
        keyboardType={keyboardType}
        onChangeText={onChangeText}
        placeholderTextColor={Colors.colorGullGray}
        returnKeyType={returnKeyType}
        textAlign={rtl ? 'right' : 'left'}
      />
    </Item>
  );
};
const styles = StyleSheet.create({
  txtInput_Container: {
    width: wp('90%'),
    height: hp('9%'),
    marginVertical: 5,
    borderRadius: 10,
    backgroundColor: Colors.colorWhite,
    paddingHorizontal: 10,
    flexDirection: 'row',
  },
  icon_TextInput: {color: Colors.colorBlack, paddingVertical: 20},
});
