import React from "react";
import { Text, Box, Image } from "@chakra-ui/react";


const HeroProfile = ({ infos }) => {
    const { vie, nom, image } = infos;
    return <Box textAlign={'center'} alignContent={'center'}>
      <Image src={image} alt='Player profile' display={'inline'} borderRadius='full' boxSize='150px' />
      <Box>
        <Text fontSize={'4xl'}>{nom}</Text>
      </Box>
    </Box>
}

export default HeroProfile;