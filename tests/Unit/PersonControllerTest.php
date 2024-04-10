<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Person;
use Database\Factories\PersonFactory;
use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;

class PersonControllerTest extends TestCase
{
    /**
     * Test para el método registro.
     */
    public function testRegistro()
    {
        // Crear una instancia de PersonController
        $controller = new PersonController();

        // Crear una instancia de Request con datos simulados
        $request = new Request([
            'identification' => '123456789',
            'name' => 'John',
            'lastname' => 'Doe',
            'type_person_id' => 1,
            'job' => 'Engineer',
            'destination' => 'Development',
            'address' => '123 Main St',
            'phone' => '1234567890',
            'email' => 'john@example.com',
            'reason' => 'Some reason',
        ]);

        // Llamar al método registro
        $response = $controller->registro($request);

        // Verificar que la respuesta sea válida
        $this->assertEquals(201, $response->getStatusCode());
        
        // Verificar que la respuesta contiene el mensaje y los datos de la persona
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals('persona registrada satisfactoriamente', $responseData['message']);
        $this->assertArrayHasKey('person', $responseData);
        // Aquí podrías hacer más aserciones sobre los datos de la persona si es necesario
    }

    /**
     * Test para el método buscar.
     */
    public function testBuscar()
    {
        // Crear una instancia de PersonController
        $controller = new PersonController();

        // Crear una instancia de Request con datos simulados
        $request = new Request([
            'identification' => '123456789',
        ]);

        // Llamar al método buscar
        $response = $controller->buscar($request);

        // Verificar que la respuesta sea válida
        $this->assertEquals(201, $response->getStatusCode());

        // Verificar que la respuesta contiene los datos de la persona
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('person', $responseData);
        // Aquí podrías hacer más aserciones sobre los datos de la persona si es necesario
    }

    /**
     * Test para el método borrar.
     */
    public function testBorrar()
    {
        // Crear una instancia de PersonController
        $controller = new PersonController();

        // Simular la existencia de una persona en la base de datos
        $person = PersonFactory::new()->create(['identification' => '123456789']);


        // Simular la existencia de una persona en la base de datos
        //$person = Person::factory()->create(['identification' => '123456789']);

        // Crear una instancia de Request con datos simulados
        $request = new Request([
            'id' => $person->id,
        ]);

        // Llamar al método borrar
        $response = $controller->borrar($request);

        // Verificar que la respuesta sea válida
        $this->assertEquals(200, $response->getStatusCode());

        // Verificar que la persona ha sido eliminada correctamente
        $responseData = json_decode($response->getContent(), true);
        $this->assertTrue($responseData['success']);

        // Verificar que la persona ya no existe en la base de datos
        $this->assertNull(Person::find($person->id));
    }
}
