import {Icon, Item} from 'native-base';
import React from 'react';
import {I18nManager, StyleSheet} from 'react-native';
import DatePicker from 'react-native-datepicker';
import {Colors} from '../constants';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
export const ExtremeLabDatePicker = ({
  dateValue,
  onDateChange,
  placeholderTxt,
  confirmTxt,
  cancalTxt,
  minDate = '1920-01-01',
  maxDate = new Date(),
  iconName = 'date',
  iconType = 'Fontisto',
}) => {
  return (
    <Item style={styles.item_DateContainer} rounded>
      <Icon active name={iconName} type={iconType} style={styles.icon_Date} />
      <DatePicker
        format={!I18nManager.isValid ? 'YYYY-MM-DD' : 'DD-MM-YYYY'}
        modalTransparent={false}
        androidMode={'default'}
        placeholder={placeholderTxt}
        onDateChange={onDateChange}
        disabled={false}
        showIcon={false}
        date={dateValue}
        style={{flex: 1}}
        mode="date"
        confirmBtnText={confirmTxt}
        cancelBtnText={cancalTxt}
        maxDate={maxDate}
        minDate={minDate}
        customStyles={{
          dateInput: {
            borderWidth: 0,
            alignItems: 'flex-start',
            marginHorizontal: 15,
          },
        }}
      />
    </Item>
  );
};

const styles = StyleSheet.create({
  item_DateContainer: {
    width: wp('90%'),
    height: hp('9%'),
    marginVertical: 5,
    borderRadius: 10,
    backgroundColor: Colors.colorWhite,
    paddingHorizontal: 10,
  },
  icon_Date: {color: Colors.colorBlack},
});
