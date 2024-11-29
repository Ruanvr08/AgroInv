using System;
using System.Collections.Generic;

namespace ONGAnimais
{
    // Classe para representar Tipo de Animal
    public class TipoAnimal
    {
        public int Codigo { get; private set; }
        public string Nome { get; private set; }

        public TipoAnimal(int codigo, string nome)
        {
            Codigo = codigo;
            Nome = nome;
        }

        public override string ToString()
        {
            return $"TipoAnimal: [Código: {Codigo}, Nome: {Nome}]";
        }
    }

    // Classe para representar Pet
    public class Pet
    {
        public string Nome { get; private set; }
        public DateTime DataNascimento { get; private set; }
        public TipoAnimal Tipo { get; private set; }

        public Pet(string nome, DateTime dataNascimento, TipoAnimal tipo)
        {
            Nome = nome;
            DataNascimento = dataNascimento;
            Tipo = tipo;
        }

        public override string ToString()
        {
            return $"Pet: [Nome: {Nome}, Data de Nascimento: {DataNascimento.ToShortDateString()}, Tipo: {Tipo.Nome}]";
        }
    }

    // Classe para representar Pessoa
    public class Pessoa
    {
        public string Nome { get; private set; }
        public string CPF { get; private set; }
        public string Telefone { get; private set; }
        public string Email { get; private set; }
        public Pet PetAdotado { get; private set; }

        public Pessoa(string nome, string cpf, string telefone, string email)
        {
            Nome = nome;
            CPF = cpf;
            Telefone = telefone;
            Email = email;
        }

        public void AdotarPet(Pet pet)
        {
            if (PetAdotado != null)
            {
                throw new Exception("A pessoa já adotou um pet.");
            }

            if (CalcularIdade() < 18)
            {
                throw new Exception("Somente pessoas com mais de 18 anos podem adotar um pet.");
            }

            PetAdotado = pet;
        }

        private int CalcularIdade()
        {
            // Exemplo simples: simula a idade como sendo baseada nos primeiros 4 dígitos do CPF.
            int anoNascimento = int.Parse(CPF.Substring(0, 4));
            return DateTime.Now.Year - anoNascimento;
        }

        public override string ToString()
        {
            return $"Pessoa: [Nome: {Nome}, CPF: {CPF}, Telefone: {Telefone}, Email: {Email}, Pet Adotado: {PetAdotado?.Nome ?? "Nenhum"}]";
        }
    }

    // Classe para representar a ONG
    public class ONG
    {
        public List<TipoAnimal> TiposAnimais { get; private set; } = new List<TipoAnimal>();
        public List<Pet> Pets { get; private set; } = new List<Pet>();
        public List<Pessoa> Pessoas { get; private set; } = new List<Pessoa>();

        public void CadastrarTipoAnimal(TipoAnimal tipo)
        {
            TiposAnimais.Add(tipo);
        }

        public void CadastrarPet(Pet pet)
        {
            Pets.Add(pet);
        }

        public void CadastrarPessoa(Pessoa pessoa)
        {
            Pessoas.Add(pessoa);
        }
    }

    // Classe principal para executar o programa
    class Program
    {
        static void Main(string[] args)
        {
            ONG ong = new ONG();

            // Cadastrar tipos de animais
            TipoAnimal gato = new TipoAnimal(1, "Gato");
            TipoAnimal cachorro = new TipoAnimal(2, "Cachorro");
            ong.CadastrarTipoAnimal(gato);
            ong.CadastrarTipoAnimal(cachorro);

            // Cadastrar pets
            Pet pet1 = new Pet("Mimi", new DateTime(2020, 5, 15), gato);
            Pet pet2 = new Pet("Rex", new DateTime(2019, 8, 20), cachorro);
            ong.CadastrarPet(pet1);
            ong.CadastrarPet(pet2);

            // Cadastrar pessoas
            Pessoa pessoa1 = new Pessoa("João", "19900101", "123456789", "joao@gmail.com");
            Pessoa pessoa2 = new Pessoa("Maria", "20050505", "987654321", "maria@gmail.com");
            ong.CadastrarPessoa(pessoa1);
            ong.CadastrarPessoa(pessoa2);

            // Tentativa de adoção
            try
            {
                pessoa1.AdotarPet(pet1);
                Console.WriteLine($"{pessoa1.Nome} adotou o pet {pessoa1.PetAdotado.Nome}");
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Erro: {ex.Message}");
            }

            try
            {
                pessoa2.AdotarPet(pet2);
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Erro: {ex.Message}");
            }
        }
    }
}
