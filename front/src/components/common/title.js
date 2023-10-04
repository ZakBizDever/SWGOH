import React from "react";
import { Text, Center, Button, VStack } from "@chakra-ui/react";
import { Link } from "react-router-dom";

const Title = ({ title, backUrl, backText }) => {
    return <Center>
                <VStack>
                    <Text fontSize='6xl' my={5}>{title}</Text>
                    <Link to={backUrl} exact><Button colorScheme="red">{backText}</Button></Link>
                </VStack>
            </Center>;
}


export default Title;