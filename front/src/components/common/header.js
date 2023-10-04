import React from "react";
import { Flex, Center, Box } from "@chakra-ui/react";

const Header = () => {
  return (
    <Flex
      bg="tomato"
      height={60}
      alignItems={"center"}
      justifyContent={"center"}
      bgImage={"url('/images/sw-banner.jpg')"}
      bgPosition={"50% 40%"}
    >
      {/* <Box className="banner-overlay"></Box> */}
    </Flex>
  );
};

export default Header;
