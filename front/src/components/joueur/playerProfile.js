import React from "react";
import { Box, Image, Text,  } from '@chakra-ui/react';

const PlayerProfile = ({ infos }) => {
    const { titre, pseudo, portrait_image } = infos;
    return <Box textAlign={'center'} alignContent={'center'}>
      <Image src={portrait_image} alt='Player profile' display={'inline'} borderRadius='full' boxSize='150px' />
      <Box>
        <Text fontSize={'4xl'}>{titre}</Text>
        <Text fontSize={'2xl'}>{pseudo}</Text>
      </Box>
      
    </Box>
  }

export default PlayerProfile;