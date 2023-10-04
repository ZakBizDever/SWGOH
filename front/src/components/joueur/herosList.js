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

const HerosList = ({ heros, playerCode }) => {
  if (!heros.length) return <Text fontStyle={"italic"}>Aucun résultat</Text>;
  return (
    <SimpleGrid columns={[1, 2, 2, 3]} spacing={5}>
      {heros.map((hero) => {
        const { image, nom, id } = hero;
        return (
          <Link to={`/hero/${playerCode}/${id}`}>
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

export default HerosList;
