import React from 'react';
import {StyleSheet} from 'react-native';
import {Header, Left, Body, Right, Title, Icon} from 'native-base';
import {Colors, Fonts} from '../constants';
export const CustomHeader = ({TitleTxt, LeftComponent, RightComponent,navigation}) => {
  return (
    <Header
      style={{backgroundColor: '#002A9E'}}
      androidStatusBarColor={Colors.colorMidnightBlue}
      noShadow>
      <Left style={styles.header_LeftRight}>
        {!!LeftComponent ? (
          LeftComponent()
        ) : (
          <Icon
            name="test-tube"
            type="Fontisto"
            style={styles.icon_BackArrow}
          />
        )}
      </Left>
      <Body style={styles.header_Body}>
        <Title
          style={[styles.txt_Title, {fontWeight: 'bold', alignSelf: 'center'}]}>
          {TitleTxt}
        </Title>
      </Body>
      <Right style={styles.header_LeftRight}>
      {!!RightComponent ? (
          RightComponent()
        ) : (
          <Icon name="blood-test" type="Fontisto" style={styles.icon_BackArrow} />
        )}
      </Right>
    </Header>
  );
};
const styles = StyleSheet.create({
  header_LeftRight: {flex: 1},
  header_Body: {
    flex: 3,
  },
  txt_Title: {
    color: Colors.colorWhite,
    fontSize: Fonts.size.regular,
  },
  icon_BackArrow: {color: Colors.colorWhite, fontSize: 25},
});
