import React from 'react';
import {View, Text, StyleSheet} from 'react-native';
import {Icon} from 'native-base';
import {Colors} from '../constants';
import { useTranslation } from 'react-i18next';
export const NoDataFound = ({label}) => {
  const {t} = useTranslation();
  return (
    <View style={styles.view_Container}>
      <Icon
        name="ios-information-circle"
        type="Ionicons"
        style={styles.icon_Information}
      />
      <Text style={styles.txt_Information}>{`${t('GENERAL:No')} ${label} ${t('GENERAL:found')}`}</Text>
    </View>
  );
};
const styles = StyleSheet.create({
  view_Container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  txt_Information: {
    marginTop: 14,
    fontSize: 14,
    fontFamily: 'Avenir',
    color: Colors.colorBlack,
    fontWeight: 'bold',
  },
  icon_Information: {fontSize: 30, color: Colors.colorBlack},
});
