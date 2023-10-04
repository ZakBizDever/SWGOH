import React from "react";
import {
  Text,
  VStack,
  SimpleGrid,
  Card,
  CardHeader,
  Avatar,
  Heading,
} from "@chakra-ui/react";
import { Link } from "react-router-dom";

const VaisseauxList = ({ vaisseaux, playerCode }) => {
  if (!vaisseaux.length)
    return <Text fontStyle={"italic"}>Aucun résultat</Text>;
  return (
    <SimpleGrid columns={[1, 2, 2, 3]} spacing={5}>
      {vaisseaux.map((vaisseau) => {
        const { image, nom, id } = vaisseau;
        return (
          <Link to={`/vaisseau/${playerCode}/${id}`}>
            <Card maxW="md">
              <CardHeader>
                <VStack spacing="4" justifyContent={"center"}>
                  <Avatar name={nom} src={image} />
                  <Heading size="sm">{nom}</Heading>
                </VStack>
              </CardHeader>
            </Card>
          </Link>
        );
      })}
    </SimpleGrid>
  );
};
export default VaisseauxList;
